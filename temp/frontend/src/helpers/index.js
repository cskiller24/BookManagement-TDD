/**
 * Helper for parsing the html title of the page.
 * Format : `${pageTitle} | ${APP_TITLE}`
 *
 * @param {string} pageTitle
 * @param {string} fallback
 * @returns
 */
export const parseTitle = (pageTitle, fallback = "Title") => {
    let title = process.env.VUE_APP_TITLE
        ? process.env.VUE_APP_TITLE
        : fallback;
    return `${pageTitle} | ${title}`;
};
