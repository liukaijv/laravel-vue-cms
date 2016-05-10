export function ucFirst(word) {
    return word.replace(/(\w)/, function (v) {
        return v.toUpperCase();
    });
}

export function extend(out = {}) {
    for (var i = 1; i < arguments.length; i++) {
        if (!arguments[i]) {
            continue;
        }

        for (var key in arguments[i]) {
            if (arguments[i].hasOwnProperty(key)) {
                out[key] = arguments[i][key];
            }
        }
    }
    return out;
}