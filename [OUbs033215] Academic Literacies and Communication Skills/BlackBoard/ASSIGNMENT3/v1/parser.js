// Include the compromise library via CDN or package manager
const nlp = window.nlp;

// Function to parse sentence input
function parseSentence() {
    const input = document.getElementById('sentence').value;

    // Parse the sentence using compromise NLP
    const doc = nlp(input);

    // Tokenization - break into words
    const tokens = doc.terms().out('array');

    // POS Tagging (Part of Speech)
    const tagged = doc.terms().data().map(term => ({
        word: term.text,
        partOfSpeech: term.tags.join(', ')
    }));

    // Display results
    let output = `<h3>Parsed Results</h3>`;
    output += `<strong>Tokenized Words:</strong> ${tokens.join(', ')}<br>`;
    output += `<strong>Part-of-Speech Tags:</strong> <ul>`;

    tagged.forEach(tag => {
        output += `<li>${tag.word} - ${tag.partOfSpeech}</li>`;
    });

    output += `</ul>`;
    document.getElementById('output').innerHTML = output;
}
