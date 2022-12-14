import type { IImage } from "./IImage";
import type { IGenre } from "./IGenre";
import type { IRecommendation } from "./IRecommendations";
import type { IReviews } from "./IReviews";
import type { IUser } from "./IUser";

export interface IBook {
    id: number;
    title: string;
    description: string;
    average_review: number;

    user: IUser;
    genre: IGenre;
    featured_image: IImage;
    images: Array<IImage>;
    reviews: Array<IReviews>;
    recommendation?: IRecommendation;
}
