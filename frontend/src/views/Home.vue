<script setup lang="ts">
import ParentCard from '@/components/shared/ParentCard.vue';
import dashboardService from '@/services/products/dashboard.service';
import { format } from 'date-fns';
import { onMounted, ref } from 'vue';

const totalStock = ref();
const pricePerCategory = ref([]);
const lastMovements = ref([]);

onMounted(async () => {
    await getTotalAmount();
    pricePerCategory.value = await dashboardService.totalPerCategory();
    lastMovements.value = await dashboardService.lastMovements();
});

async function getTotalAmount() {
    const amount = await dashboardService.totalAmount();
    totalStock.value = formatMonetaryValue(amount.total);
}

function formatMonetaryValue(value: number) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(value / 100);
}

function formatDate(date: string) {
    return format(date, 'dd/MM/yyyy HH:ss')
}
</script>

<template>
    <ParentCard title="Dashboard">
        <v-row class="mb-4">
            <v-col cols="12" md="4">
                <v-card color="primary" dark class="pa-4">
                    <div class="text-h6">Total em Estoque</div>
                    <div class="text-h4 font-weight-bold mt-2">{{ totalStock }}</div>
                </v-card>
            </v-col>
            <v-col cols="12" md="8">
                <v-card class="pa-4">
                    <div class="text-h6 mb-2">Preço por Categoria</div>
                    <v-row>
                        <v-col v-for="category in pricePerCategory" :key="category.name" cols="12" sm="4">
                            <v-sheet class="pa-3 text-center" color="grey-lighten-4" rounded>
                                <div class="text-subtitle-1">{{ category.name }}</div>
                                <div class="text-h6 font-weight-bold">{{ formatMonetaryValue(category.amount) }}</div>
                            </v-sheet>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card class="pa-4">
                    <div class="text-h6 mb-2">Últimos Movimentos</div>
                    <v-table density="comfortable">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Tipo</th>
                                <th>Quantidade</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="movement in lastMovements" :key="movement.product + movement.date">
                                <td>{{ movement.product }}</td>
                                <td>
                                    <v-chip :color="movement.type === 'in' ? 'success' : 'error'" dark>
                                        {{ movement.type === 'in' ? 'Entrada' : 'Saida' }}
                                    </v-chip>
                                </td>
                                <td>{{ movement.quantity }}</td>
                                <td>{{ formatDate(movement.date) }}</td>
                            </tr>
                        </tbody>
                    </v-table>
                </v-card>
            </v-col>
        </v-row>
    </ParentCard>
</template>