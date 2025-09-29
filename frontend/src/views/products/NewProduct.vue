<script setup lang="ts">
import ParentCard from '@/components/shared/ParentCard.vue';
import router from '@/router';
import categoryService from '@/services/products/category.service';
import productService from '@/services/products/product.service';
import { useAlertStore } from '@/stores/alert.store';
import type { Category } from '@/types/products/Category';
import type { ProductInput } from '@/types/products/Products';
import { onMounted, reactive, ref, watch } from 'vue';
import { useCurrencyInput } from 'vue-currency-input';

const alertStore = useAlertStore();

const categories = ref<Category[]>();

const {inputRef, formattedValue, numberValue, setValue} = useCurrencyInput({
    locale: 'pt-BR',
    currency: 'BRL',
    precision: 2,
    hideCurrencySymbolOnFocus: false,
    hideGroupingSeparatorOnFocus: false,
    valueRange: { min: 0 }
});

const product = reactive<ProductInput>({
    name: '',
    price: 0,
    quantity: 0,
    categories: []
});

onMounted(async () => {
    categories.value = await categoryService.fetchCategories();
});

watch(numberValue, (newValue) => {
    product.price = newValue ? newValue * 100 : 0;
});

async function save() {
    try {
        await productService.create(product);
        await alertStore.success('Produto cadastrado com sucesso!');
        router.push('/products');
    } catch (error) {
        await alertStore.error(error.message)
    }
}
</script>

<template>
    <ParentCard title="Novo Produto">
        <v-row>
            <v-col cols="12" sm="4">
                <v-text-field label="Nome" v-model="product.name" />
            </v-col>
            <v-col cols="12" sm="4">
                <v-text-field label="Valor unitário" ref="inputRef" v-model="formattedValue"></v-text-field>
            </v-col>
            <v-col cols="12" sm="2">
                <v-number-input label="Quantidade inicial" control-variant="split" :min="0" v-model="product.quantity" />
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="6">
                <v-autocomplete
                    :items="categories"
                    item-title="name"
                    item-value="id"
                    label="Categoria(s)"
                    chips
                    multiple
                    clearable
                    v-model="product.categories"
                />
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="2">
                <v-btn color="success" @click="save">Salvar</v-btn>
            </v-col>
        </v-row>
    </ParentCard>
</template>