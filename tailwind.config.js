module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    daisyui: {
        themes: [
            "dark",
            "light",
            "cupcake",
            "bumblebee",
            "emerald",
            "corporate",
            "synthwave",
            "retro",
            "cyberpunk",
            "valentine",
            "halloween",
            "garden",
            "forest",
            "aqua",
            "lofi",
            "pastel",
            "fantasy",
            "wireframe",
            "black",
            "luxury",
            "dracula",
            "cmyk",
            "autumn",
            "business",
            "acid",
            "lemonade",
            "night",
            "coffee",
            "winter",
            {
                Dashboard: {
                    primary: "#174491",

                    secondary: "#656BF1",

                    accent: "#253CA7",

                    neutral: "#1E283D",

                    "base-100": "#f5f5f5",

                    info: "#4AA8BF",

                    success: "#43d169",

                    warning: "#EF8234",

                    error: "#EA4034",
                },
            },
        ],
    },
    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],
};
