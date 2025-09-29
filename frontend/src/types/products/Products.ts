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