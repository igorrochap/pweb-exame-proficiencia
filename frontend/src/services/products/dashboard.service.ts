import http from "../http";

type TotalAmount = {
    total: number
}

type PerCategory = {
    name: string,
    amount: number
}

type LastMovements = {
    product: string,
    date: string,
    quantity: number,
    type: 'in' | 'out'
}

export default {
    async totalAmount(): Promise<TotalAmount> {
        const { data } = await http.get('/dashboard/total');
        return data;
    },

    async totalPerCategory(): Promise<PerCategory> {
        const { data } = await http.get('/dashboard/top-categories');
        return data;
    },

    async lastMovements(): Promise<LastMovements> {
        const { data } = await http.get('/dashboard/last-movements');
        return data;
    }
}