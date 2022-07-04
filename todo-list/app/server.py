#!/usr/bin/python3
from flask import Flask, render_template_string, send_from_directory
import os

app = Flask(__name__)
PORT = os.environ.get('PORT', 3000)


class Todo:
    def __init__(self, id, text):
        self.id = id
        self.text = text


todos = []
todos.append(Todo(1, 'Primeira tarefa'))
todos.append(Todo(2, 'Segunda tarefa'))
todos.append(Todo(3, 'Terceira tarefa'))


@app.route('/')
def index():
    with open('index.html') as f:
        template = f.read()
        data = ''
        for item in todos:
            data += f"<td>{item.id}</td>"
            data += f"<td>{item.text}</td>"
        data += '</tr>'
        return render_template_string(template, todos=data)


@app.route('/static/<path:path>')
def send_file(path):
    return send_from_directory('static', path)


if __name__ == "__main__":
    app.run(debug=False, host="0.0.0.0", port=PORT)
