import type { IImage } from "./IImage";
import type { IGenre } from "./IGenre";
import type { IUser } from "./IUser";

export interface IBooks {
    id: number;
    title: string;
    description: string;
    favorites_count: number;

    user: IUser;
    genre: IGenre;
    featured_image: IImage;
    images: Array<IImage>;
}
