import type { RouteLocationNormalized } from "vue-router";

export default (mapping) => {
    return function (route: RouteLocationNormalized) {
        let nameType = Object.entries(mapping); // [[param1, Number], [param2, String]]
        let nameRouteParam = nameType.map(([name, fn]) => [
            name,
            fn(route.params[name]),
        ]); // [[param1, 1], [param2, "hello"]]
        let props = Object.fromEntries(nameRouteParam); // {param1: 1, param2: "hello"}
        return props;
    };
};
