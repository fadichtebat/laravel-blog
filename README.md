# laravel-blog

# 🚀 Laravel Blog Project

This is a simple **Laravel Blog** with authentication, CRUD operations, comments, search, and pagination.

## 📌 Features
✅ User authentication (register, login, logout)  
✅ Create, edit, delete, and list blog posts  
✅ Add comments to posts  
✅ Bootstrap-styled UI  
✅ Search functionality  
✅ Pagination (20 posts per page)  
✅ Delete confirmation using Bootstrap modal  

---

## **🛠️ Installation Guide**
### **1️⃣ Clone the Repository**
```bash
git clone https://github.com/yourusername/your-repository.git
cd your-repository
```

### **2️⃣ Install Dependencies**
Make sure you have **Composer** and **Node.js** installed.
```bash
composer install
npm install
```

### **3️⃣ Configure Environment**
Copy `.env.example` and create your `.env` file:
```bash
cp .env.example .env
```
Then, update these values in `.env`:
```ini
APP_NAME="Laravel Blog"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_larv
DB_USERNAME=root
DB_PASSWORD=
```
*(Change `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` according to your database setup.)*

### **4️⃣ Generate Application Key**
```bash
php artisan key:generate
```

### **5️⃣ Setup Database**
Run migrations and seeders to create tables and add test data:
```bash
php artisan migrate --seed
```

### **6️⃣ Run Laravel Development Server**
Start the Laravel application:
```bash
php artisan serve
```
Visit **[http://127.0.0.1:8000](http://127.0.0.1:8000)** in your browser.

---

## **🎨 Frontend Setup**
### **1️⃣ Build CSS & JavaScript**
If you're using Laravel Vite, compile assets:
```bash
npm run dev
```
For production:
```bash
npm run build
```

### **2️⃣ Start Vite Server (if needed)**
```bash
npm run dev
```

---

## **🔍 Available Routes**
| Route | Method | Description |
|--------|--------|------------|
| `/register` | GET, POST | User Registration |
| `/login` | GET, POST | User Login |
| `/logout` | POST | User Logout |
| `/posts` | GET | List all posts |
| `/posts/create` | GET | Show create post form |
| `/posts` | POST | Store new post |
| `/posts/{id}` | GET | Show a single post |
| `/posts/{id}/edit` | GET | Show edit post form |
| `/posts/{id}` | PUT/PATCH | Update post |
| `/posts/{id}` | DELETE | Delete post (if no comments) |
| `/comments` | POST | Add a comment |

---

## **🚧 Deleting Posts with Comments**
- If a post **has comments**, the delete button is **disabled**.
- You can only delete posts **without comments**.

---

## **🔧 Troubleshooting**
If you encounter any issues, try:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
npm run build
```

---

## **👨‍💻 Author**
Developed by *Fadi Chtebat*  
GitHub: [@fadichtebat](https://github.com/fadichtebat)

---

## **📚 License**
This project is open-source and free to use.  
Feel free to modify and improve it!

