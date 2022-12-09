import type { IUser } from "./IUser";

export interface IReviews {
    id: number;
    user_id: number;
    book_id: number;
    star: number;
    title: string;
    description: string;

    user: IUser;
}
