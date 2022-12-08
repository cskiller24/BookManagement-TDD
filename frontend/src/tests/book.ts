export default {
    user: {
        id: 2,
        name: "Arely Heller II",
        email: "veronica50@example.org",
        is_admin: false,
        is_verified: true,
    },
    genre: {
        id: 50,
        title: "Self Help",
        type: "Non-Fiction",
        description:
            "Books in the self-help nonfiction genre are based on one's own effort and resources to achieve things and goals without relying on the help of others.",
    },
    featured_image: {
        path: "http://api.book-management.test:8000/storage/images/default_image.png",
        id: 54,
    },
    images: [
        {
            path: "http://api.book-management.test:8000/storage/images/default_image.png",
            id: 54,
        },
    ],
    reviews: [
        {
            user: {
                id: 22,
                name: "Mr. Douglas Boyer",
                email: "block.leda@example.com",
                is_admin: false,
                is_verified: true,
            },
            id: 1,
            user_id: 22,
            book_id: 1,
            star: 1,
            title: "Consequatur Mollitia Ut Incidunt.",
            description:
                "Vel in nesciunt aliquam ut aut. Animi voluptatem quisquam numquam aut hic minima voluptatibus in. Fuga non cumque sit quo nesciunt optio.",
        },
        {
            user: {
                id: 23,
                name: "Hellen Donnelly Sr.",
                email: "hstroman@example.org",
                is_admin: false,
                is_verified: true,
            },
            id: 2,
            user_id: 23,
            book_id: 1,
            star: 5,
            title: "Est Ipsum Ab Quibusdam Nemo.",
            description:
                "Repudiandae doloribus modi necessitatibus molestiae quia rerum qui. Molestiae animi et est aut dolorem veniam labore. Natus iste voluptatem corporis ipsum et.",
        },
    ],
    recommendation: {
        images: [
            {
                path: "http://api.book-management.test:8000/storage/images/default_image.png",
                id: 66,
            },
        ],
        id: 13,
        title: "Voluptatem Tempore Qui Consequuntur Voluptatem Sapiente.",
        description:
            "Sint earum explicabo ut. Perferendis molestiae unde nam autem autem rerum sit. Quasi eaque ut rerum soluta.",
    },
    average_review: 3,
    id: 1,
    title: "Vel Facere Voluptatum Saepe Qui.",
    description:
        "Expedita animi dolor dolorum aperiam fugit. Quo iusto inventore amet expedita et sit ipsum magni. Molestiae quia quia fuga id nesciunt ut.",
};
