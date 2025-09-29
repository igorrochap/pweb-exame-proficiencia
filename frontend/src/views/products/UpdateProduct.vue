<script setup lang="ts">
import ParentCard from '@/components/shared/ParentCard.vue';
import router from '@/router';
import categoryService from '@/services/products/category.service';
import productService from '@/services/products/product.service';
import { useAlertStore } from '@/stores/alert.store';
import type { Category } from '@/types/products/Category';
import type { Product, ProductInput } from '@/types/products/Products';
import { onMounted, reactive, ref, watch } from 'vue';
import { useCurrencyInput } from 'vue-currency-input';
import { useRoute } from 'vue-router';

const alertStore = useAlertStore();
const route = useRoute();

const categories = ref<Category[]>();
const productToUpdate = ref<Product>();

const { inputRef, formattedValue, numberValue, setValue } = useCurrencyInput({
    locale: 'pt-BR',
    currency: 'BRL',
    precision: 2,
    hideCurrencySymbolOnFocus: false,
    hideGroupingSeparatorOnFocus: false,
    valueRange: { min: 0 }
});

const product = reactive<Omit<ProductInput, 'quantity'>>({
    name: '',
    price: 0,
    categories: []
});

onMounted(async () => {
    const productId = route.params.id as string;
    categories.value = await categoryService.fetchCategories();
    productToUpdate.value = await productService.findById(productId);

    if (productToUpdate.value) {
        product.name = productToUpdate.value.name;
        setValue(productToUpdate.value.price / 100);
        product.categories = productToUpdate.value.categories.map(category => category.id);
    }
});

watch(numberValue, (newValue) => {
    product.price = newValue ? newValue * 100 : 0;
});

async function save() {
    try {
        const productId = route.params.id as string;
        await productService.update(productId, product);
        await alertStore.success('Produto atualizado com sucesso!');
        router.push('/products');
    } catch (error) {
        await alertStore.error(error.message);
    }
}
</script>

<template>
    <ParentCard title="Atualizar Produto">
        <template v-slot:action>
            <v-btn color="primary" to="/products">
                <v-icon icon="mdi-arrow-left" />Voltar
            </v-btn>
        </template>
        <v-row>
            <v-col cols="12" sm="6">
                <v-text-field label="Nome" v-model="product.name" />
            </v-col>
            <v-col cols="12" sm="6">
                <v-text-field label="Valor unitário" ref="inputRef" v-model="formattedValue"></v-text-field>
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