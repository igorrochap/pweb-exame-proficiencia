import type { Category } from "@/types/products/Category";
import http from "../http";

export default {
    async fetchCategories(): Promise<Category[]> {
        const { data } = await http.get<Category[]>(`/categories`);
        return data;
    }
}