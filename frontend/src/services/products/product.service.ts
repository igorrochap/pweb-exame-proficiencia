import type { MovementInput, PaginatedProducts, Product, ProductInput } from "@/types/products/Products";
import http from "../http";

export default {
    async fetchProducts(searchName: string, page: number = 1): Promise<PaginatedProducts> {
        const query = {name: searchName, page};
        const { data } = await http.get<PaginatedProducts>(`/products`, { params: query });
        return data;
    },

    async create(product: ProductInput): Promise<Product> {
        const { data } = await http.post<Product>(`/products`, product);
        return data;
    },

    async createMovement(movement: MovementInput): Promise<Response> {
        const { data } = await http.post(`/products/${movement.product_id}/movement`, movement);
        return data;
    },

    async findById(id: string): Promise<Product> {
        const { data } = await http.get<Product>(`/products/${id}`);
        return data;
    },

    async update(id: string, product: ProductInput): Promise<Product> {
        const { data } = await http.put<Product>(`/products/${id}`, product);
        return data;
    },

    async delete(productId: string): Promise<void> {
        await http.delete(`/products/${productId}`);
    }
}