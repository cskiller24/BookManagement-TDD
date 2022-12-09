import type { IImage } from "./IImage";

export interface IGenre {
    image?: IImage;
    id: number;
    title: string;
    description: string;
}
