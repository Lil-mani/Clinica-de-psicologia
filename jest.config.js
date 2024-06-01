module.exports = {
    preset: '@vue/cli-plugin-unit-jest/presets/no-babel',
    transform: {
        '^.+\\.vue$': 'vue-jest',
        '^.+\\.(js|jsx|ts|tsx)$': 'babel-jest',
    },
    moduleFileExtensions: ['js', 'json', 'vue'],
    testEnvironment: 'jsdom',
};
