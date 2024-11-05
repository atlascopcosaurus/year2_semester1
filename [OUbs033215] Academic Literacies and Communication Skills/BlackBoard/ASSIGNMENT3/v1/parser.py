from flask import Flask, request, send_file
import nltk
from nltk import CFG
import graphviz

app = Flask(__name__)


@app.route("/parse", methods=["POST"])
def parse_sentence():
    sentence = request.form["sentence"].split()

    # Define the grammar
    grammar = CFG.fromstring(
        """
      S -> NP VP
      NP -> Det N | 'She'
      VP -> V NP | V PP
      PP -> P NP
      Det -> 'a' | 'the'
      N -> 'dog' | 'stoops' | 'conquer'
      V -> 'stoops' | 'conquer'
      P -> 'to'
    """
    )

    parser = nltk.ChartParser(grammar)
    for tree in parser.parse(sentence):
        tree_graph = graphviz.Source(tree._repr_dot_())
        tree_graph.render("parse_tree", format="png")

    # Return the generated image
    return send_file("parse_tree.png", mimetype="image/png")


if __name__ == "__main__":
    app.run(debug=True)
