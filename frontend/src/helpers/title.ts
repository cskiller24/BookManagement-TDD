const FORMATTER: string = "Book Management";

export default (title: string | null = null, append: boolean = true): void => {
    if (append && title) {
        document.title = `${title} | ${FORMATTER}`;
        return;
    }
    if (title == null) {
        document.title = FORMATTER;
        return;
    }
    document.title = `${title}`;
};
