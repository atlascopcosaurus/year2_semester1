from flask import Flask, request, send_file, render_template
import nltk
from nltk import CFG
import graphviz

app = Flask(__name__)


@app.route("/")
def index():
    return render_template("index.html")  # Flask looks inside the 'templates' folder


app.route("/parse", methods=["POST"])


def parse_sentence():
    # Convert the sentence to lowercase to match grammar
    sentence = request.form["sentence"].lower().split()

    # Define the grammar
    grammar = CFG.fromstring(
        """
      S -> NP VP
      NP -> Det N | 'she'
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
