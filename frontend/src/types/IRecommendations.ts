import type { IImage } from "./IImage";

export interface IRecommendation {
    id: number;
    title: string;
    description: string;

    images: Array<IImage>;
}
