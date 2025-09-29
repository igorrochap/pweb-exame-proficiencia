<script setup lang="ts">

import productService from '@/services/products/product.service';
import { useAlertStore } from '@/stores/alert.store';
import type { MovementInput } from '@/types/products/Products';
import { defineProps, ref } from 'vue';

const props = defineProps({
    type: {
        type: String as () => 'in' | 'out',
        required: true
    },
    product_id: {
        type: String,
        required: true
    }
});
const alertStore = useAlertStore();
const quantity = ref<number>()

const typeInfo = {
    'in': {icon: 'mdi-arrow-right-thick', text: 'Entrada'},
    'out': {icon: 'mdi-arrow-left-thick', text: 'Saída'}
}

async function save() {
    try {
        const payload: MovementInput = {type: props.type, quantity: quantity.value, product_id: props.product_id};
        const movement = await productService.createMovement(payload);
        await alertStore.success(`Movimentação de ${typeInfo[props.type].text} cadastrada com sucesso!`);
        window.location.reload();
    } catch (error) {
        await alertStore.error(error.message)
    }
}
</script>

<template>
    <v-dialog max-width="500">
        <template v-slot:activator="{ props: activatorProps }">
            <v-btn v-bind="activatorProps" variant="text">
                <v-icon :icon="typeInfo[type].icon" /> Cadastrar {{typeInfo[type].text}}
            </v-btn>
        </template>

        <template v-slot:default="{ isActive }">
            <v-card :title="`Nova movimentação - ${typeInfo[type].text}`">
                <v-card-text>
                    <v-row>
                        <v-col cols="12" sm="12">
                            <v-number-input label="Quantidade" control-variant="split" :min="0" v-model="quantity" />
                        </v-col>
                    </v-row>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="success" @click="save(); isActive.value = false">Salvar</v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>