export type Product = {
    uuid: string;
    name: string;
    price: number;
    quantity: number;
}

export type PaginatedProducts = {
    data: Product[];
    total: number;
    last_page: number;
}

export type ProductInput = {
    name: string;
    price: number;
    quantity: number;
    categories: Array<number>;
}

export type MovementInput = {
    type: 'in' | 'out';
    quantity: number;
    product_id: string;
}