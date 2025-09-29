<?php

namespace Database\Seeders;

use App\Models\Product\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::query()->count() === 0) {
            Category::query()->insert([
                ["name" => "Eletrônicos"],
                ["name" => "Celulares"],
                ["name" => "Tablets"],
                ["name" => "Notebooks"],
                ["name" => "Computadores"],
                ["name" => "Acessórios de Informática"],
                ["name" => "Periféricos"],
                ["name" => "Impressoras"],
                ["name" => "Monitores"],
                ["name" => "Armazenamento"],
                ["name" => "TVs"],
                ["name" => "Áudio"],
                ["name" => "Câmeras"],
                ["name" => "Drones"],
                ["name" => "Games"],
                ["name" => "Consoles"],
                ["name" => "Brinquedos"],
                ["name" => "Livros"],
                ["name" => "E-books"],
                ["name" => "Instrumentos Musicais"],
                ["name" => "Moda Masculina"],
                ["name" => "Moda Feminina"],
                ["name" => "Calçados"],
                ["name" => "Bolsas e Acessórios"],
                ["name" => "Joias"],
                ["name" => "Relógios"],
                ["name" => "Beleza"],
                ["name" => "Perfumes"],
                ["name" => "Cuidados com a Pele"],
                ["name" => "Cabelos"],
                ["name" => "Casa"],
                ["name" => "Móveis"],
                ["name" => "Decoração"],
                ["name" => "Cozinha"],
                ["name" => "Eletrodomésticos"],
                ["name" => "Eletroportáteis"],
                ["name" => "Esporte"],
                ["name" => "Fitness"],
                ["name" => "Ciclismo"],
                ["name" => "Camping"],
                ["name" => "Ferramentas"],
                ["name" => "Automotivo"],
                ["name" => "Pet Shop"],
                ["name" => "Bebês"],
                ["name" => "Alimentos"],
                ["name" => "Bebidas"],
                ["name" => "Papelaria"],
                ["name" => "Artigos de Festa"],
                ["name" => "Saúde"],
                ["name" => "Farmácia"],
            ]);
        }
    }
}
