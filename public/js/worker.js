self.onmessage = function(e) {
    try {
        const total = 100000;
        const numeros = [];

        for (let i = 0; i < total; i++) {
            numeros.push(Math.floor(Math.random() * 1000000) + 1);
        }
        numeros.sort((a, b) => a - b);

        postMessage(numeros);
    } catch (error) {
        postMessage({ error: error.message });
    }
};
