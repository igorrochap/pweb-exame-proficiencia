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