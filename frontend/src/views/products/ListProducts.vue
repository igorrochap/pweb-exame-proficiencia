<script setup lang="ts">
import MovementDialog from '@/components/products/MovementDialog.vue';
import ParentCard from '@/components/shared/ParentCard.vue';
import productService from '@/services/products/product.service';
import type { PaginatedProducts } from '@/types/products/Products';
import { onMounted, ref, watch } from 'vue';

const products = ref<PaginatedProducts>();
const currentPage = ref<number>(1);
const searchTerm = ref<string>('');

onMounted(async () => {
    await fetchProducts();
});

watch(currentPage, async () => {
    await fetchProducts();
});

async function search() {
    currentPage.value = 1;
    await fetchProducts();
}

async function fetchProducts() {
    products.value = await productService.fetchProducts(searchTerm.value, currentPage.value);
}

function formatPrice(price: number): string {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(price / 100);
}
</script>

<template>
    <ParentCard title="Produtos">
        <template v-slot:action>
            <v-btn color="success" to="/products/create">
                <v-icon icon="mdi-plus" />Novo
            </v-btn>
        </template>
        <v-container>
            <v-form @submit.prevent="search">
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field label="Nome do produto" v-model="searchTerm"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="2">
                        <v-btn color="primary" class="mt-4" type="submit">
                            <v-icon icon="mdi-magnify" />
                        </v-btn>
                    </v-col>
                </v-row>
            </v-form>
        </v-container>
        <v-row>
            <v-col cols="12" sm="12">
                <v-table>
                    <thead>
                        <tr>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Preço</th>
                            <th class="text-center">Em estoque</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products?.data" :key="product.uuid">
                            <td class="text-center">{{ product.name }}</td>
                            <td class="text-center">{{ formatPrice(product.price) }}</td>
                            <td class="text-center">{{ product.quantity }}</td>
                            <td class="text-center">
                                <v-menu location="bottom">
                                    <template v-slot:activator="{ props }">
                                        <v-btn variant="outlined" icon color="primary" v-bind="props">
                                            <v-icon icon="mdi-dots-vertical" />
                                        </v-btn>
                                    </template>
                                    <v-list>
                                        <v-list-item>
                                            <v-list-item-title>
                                                <MovementDialog type="in" :product_id="product.uuid"/>
                                            </v-list-item-title>
                                            <v-list-item-title>
                                                <MovementDialog type="out" :product_id="product.uuid"/>
                                            </v-list-item-title>
                                                <v-btn variant="text" :to="`/products/update/${product.uuid}`">
                                                    <v-icon icon="mdi-pencil" />Editar
                                                </v-btn>
                                        </v-list-item>
                                    </v-list>
                                </v-menu>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
                <v-pagination color="primary" total-visible="10" :length="products?.last_page" v-model="currentPage" />
            </v-col>
        </v-row>
    </ParentCard>
</template>