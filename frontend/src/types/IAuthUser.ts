export default interface AuthUser {
    id: number;
    name: string;
    email: string;
    is_admin: boolean;
    is_verified: boolean;
}
