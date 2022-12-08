import type { IBookGenre } from "./IBookGenre";

export interface IGenre {
    image: {
        path: string;
        id: number;
    };
    books: Array<IBookGenre>;
    id: number;
    title: string;
    type: string;
    description: string;
}
