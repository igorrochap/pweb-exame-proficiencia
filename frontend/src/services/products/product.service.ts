import type { PaginatedProducts } from "@/types/Products";
import http from "../http";

export default {
    async fetchProducts(searchName: string, page: number = 1): Promise<PaginatedProducts> {
        const query = {name: searchName, page};
        const { data } = await http.get<PaginatedProducts>(`/products`, { params: query });
        return data;
    }
}