const express = require('express');
const axios = require('axios');
const bodyParser = require('body-parser');
const app = express();
const port = 3000;

// Define the function to describe the POS tag in layman's terms
function getPosDescription(pos) {
    const posDescriptions = {
        // Nouns
        'NN': 'Noun (a common noun like a person, place, or thing)',
        'NNS': 'Noun (plural, common noun)',
        'NNP': 'Proper Noun (specific person, place, or thing)',
        'NNPS': 'Proper Noun (plural)',

        // Pronouns
        'PRP': 'Pronoun (a word that replaces a noun, e.g., he, she, they)',
        'PRP$': 'Possessive Pronoun (e.g., his, her, their)',

        // Verbs
        'VB': 'Verb (a base form of a verb, e.g., go, eat)',
        'VBD': 'Verb (past tense, e.g., ate, went)',
        'VBG': 'Verb Gerund/Participle (verb in "-ing" form, e.g., going, eating)',
        'VBN': 'Verb (past participle, e.g., gone, eaten)',
        'VBP': 'Verb (present, non-3rd person singular, e.g., I go)',
        'VBZ': 'Verb (present, 3rd person singular, e.g., he goes)',

        // Adjectives and Adverbs
        'JJ': 'Adjective (describes a noun, e.g., big, blue)',
        'JJR': 'Adjective (comparative, e.g., bigger, smaller)',
        'JJS': 'Adjective (superlative, e.g., biggest, smallest)',
        'RB': 'Adverb (modifies a verb, adjective, or other adverb, e.g., quickly)',
        'RBR': 'Adverb (comparative, e.g., faster)',
        'RBS': 'Adverb (superlative, e.g., fastest)',

        // Determiners and Articles
        'DT': 'Determiner (e.g., the, a, an)',
        'PDT': 'Predeterminer (e.g., all, both)',

        // Conjunctions
        'CC': 'Coordinating Conjunction (connects clauses, e.g., and, but, or)',
        'IN': 'Preposition or Subordinating Conjunction (e.g., in, on, because)',

        // Possessives and Other POS
        'POS': 'Possessive Ending (e.g., \'s)',
        'TO': 'To (used for infinitive verbs, e.g., to go)',

        // Miscellaneous
        '.': 'Punctuation (e.g., period, exclamation mark)',
        ',': 'Comma',
        ':': 'Colon or Ellipsis',
        'MD': 'Modal (e.g., will, can, should)',
        'EX': 'Existential "There" (e.g., There is a cat)',
        'FW': 'Foreign Word',
        'UH': 'Interjection (e.g., wow, oh)',

        // Numbers
        'CD': 'Cardinal Number (e.g., one, two, three)',

        // Wh- Words
        'WDT': 'Wh- Determiner (e.g., which, that)',
        'WP': 'Wh- Pronoun (e.g., who, what)',
        'WP$': 'Wh- Possessive Pronoun (e.g., whose)',
        'WRB': 'Wh- Adverb (e.g., when, where)',

        // Symbols
        '$': 'Dollar sign',
        '#': 'Pound sign',
        'SYM': 'Symbol (other than punctuation, e.g., %, &)',
    };

    return posDescriptions[pos] || 'Unknown (POS tag not recognized)'; // Return description or fallback
}


// Set the view engine to ejs
app.set('view engine', 'ejs');

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));

// Route to serve the main form
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/public/index.html');
});

// Route to handle sentence parsing
app.post('/parse', async (req, res) => {
    const sentence = req.body.sentence;

    try {
        // Send sentence to Stanford CoreNLP server
        const response = await axios({
            method: 'POST',
            url: 'http://0.0.0.0:9000/', // IP address of Stanford CoreNLP server
            params: {
                properties: JSON.stringify({
                    annotators: 'tokenize,ssplit,pos,lemma,ner',
                    outputFormat: 'json'
                })
            },
            data: sentence,
            headers: {
                'Content-Type': 'text/plain'
            }
        });

        const parsedData = response.data;
        const tokens = parsedData.sentences[0].tokens;

        // Prepare a more user-friendly result for the frontend
        let results = tokens.map(token => ({
            word: token.word,
            pos: token.pos,
            lemma: token.lemma,
            ner: token.ner
        }));

        // Pass the function getPosDescription to the view
        res.render('result', {
            originalSentence: sentence,
            results: results,
            getPosDescription: getPosDescription // Pass the POS description function
        });
    } catch (error) {
        console.error('Error fetching CoreNLP response:', error);
        res.status(500).send('Error parsing the sentence.');
    }
});

// Start the server
app.listen(port, () => {
    console.log(`Server is running on http://0.0.0.0:${port}`);
});
