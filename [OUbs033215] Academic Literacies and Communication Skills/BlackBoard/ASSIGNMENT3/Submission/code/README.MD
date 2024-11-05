
### `README.md`


# Sentence Parsing Tools

This project contains two applications designed for parsing sentences using different NLP techniques: 
1. **Sentence Parsing Tool (Using Stanford CoreNLP)**: A tool that leverages Stanford CoreNLP to perform sentence parsing.
2. **Sentence Parsing Program with Mind Map**: A tool that visualizes parsed sentences as a mind map.

## Project Structure

```bash
.
├── UsingComposite
│   └── index.html          # Main file for the Sentence Parsing Program with Mind Map
├── UsingStandfordCoreNLP
│   ├── app.js              # Main Node.js application file for Stanford CoreNLP tool
│   ├── package.json        # Dependencies and project metadata
│   ├── package-lock.json   # Exact dependency tree for project
│   ├── public              # Static files directory
│   │   └── index.html      # Frontend form to submit sentences
│   ├── result.ejs          # View template for parsed sentence results
│   └── views               # Additional views for the Stanford CoreNLP tool
└── README.md               # This file
```

## URLs

- **Sentence Parsing Tool (Using Stanford CoreNLP)**: [https://doosan.pagooah.com/usingstandford/](https://doosan.pagooah.com/usingstandford/)
- **Sentence Parsing Program with Mind Map**: [https://doosan.pagooah.com/usingcomposite/](https://doosan.pagooah.com/usingcomposite/)

## Tools and Libraries

### 1. Using Stanford CoreNLP
This tool uses the Stanford CoreNLP server to parse sentences and display their structure. It utilizes:
- **Express.js**: For creating the backend server.
- **Axios**: For making HTTP requests to the Stanford CoreNLP server.
- **EJS**: As a templating engine to display results dynamically.

### 2. Using Composite (Mind Map)
This is a static HTML page that visualizes parsed sentences in the form of a mind map. It uses:
- **HTML & Bootstrap**: For UI design and layout.
- **JavaScript**: For basic frontend interactivity.

## How to Run the Project Locally

### 1. Setup for Stanford CoreNLP Tool
- Ensure you have Node.js installed on your machine.
- Clone the repository or download the project files.
- Navigate to the `UsingStandfordCoreNLP` directory and install dependencies:
  
  ```bash
  cd UsingStandfordCoreNLP
  npm install
  ```

- Start the server:
  
  ```bash
  node app.js
  ```

- Access the application at `http://localhost:3000`.

### 2. Setup for Composite (Mind Map) Tool
This is a simple HTML file located in `UsingComposite/index.html`. You can open it directly in your browser or serve it using any HTTP server (e.g., Nginx or Apache).

## Configuration for Nginx

The project is hosted using Nginx as a reverse proxy. Below is the relevant Nginx configuration for proxying the Stanford CoreNLP tool and serving the static HTML files:

```nginx
server {
    listen 80;
    server_name doosan.pagooah.com;

    # Proxy for Stanford CoreNLP Tool
    location /usingstandford {
        proxy_pass http://localhost:3000/;
        rewrite ^/usingstandford/(.*)$ /$1 break;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    # Serve static HTML for Mind Map Tool
    location /usingcomposite {
        root /var/www/parser;
        index index.html;
        try_files $uri $uri/ /index.html =404;
    }
}
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For any questions or inquiries, please contact the project maintainer at [doosan.pagooah@gmail.com](mailto:doosan.pagooah@gmail.com).


