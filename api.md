
# 🧭 دليل Postman – JWT API

## 0️⃣ إنشاء Collection

**Name**

```
API MVC - JWT
```

---

## 1️⃣ تسجيل الدخول (Login) – JWT

### 📌 Request

* **Method:** `POST`
* **URL:**

```
http://localhost/api_mvc/api/login
```

### 📌 Headers

| Key          | Value            |
| ------------ | ---------------- |
| Content-Type | application/json |

### 📌 Body (raw → JSON)

```json
{
  "email": "admin@test.com",
  "password": "123456"
}
```

### 📌 Response (مثال)

```json
{
  "status": "success",
  "message": "تم تسجيل الدخول بنجاح",
  "data": {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "user": {
      "id": 1,
      "email": "admin@test.com",
      "username": "admin",
      "full_name": "Admin User"
    }
  }
}
```

---

## 2️⃣ حفظ الـ Token تلقائيًا (مهم جدًا)

### 🔹 أنشئ Environment

* Name:

```
Local
```

### 🔹 Variable

```
token = (فارغ)
```

### 🔹 Tests (في Request login)

ضع:

```js
let res = pm.response.json();
pm.environment.set("token", res.data.token);
```

✔️ الآن أي Request يستخدم `{{token}}`

---

## 3️⃣ إعداد Authorization مرة واحدة (أفضل ممارسة)

### Collection → Authorization

* **Type:** Bearer Token
* **Token:**

```
{{token}}
```

✔️ سيطبق على كل Requests تلقائيًا

---

## 4️⃣ جلب جميع المنتجات

### 📌 Request

```
GET
http://localhost/api_mvc/api/products
```

### 🔐 Headers (تلقائي)

```
Authorization: Bearer {{token}}
```

### 📌 Response

```json
{
  "status": "success",
  "message": "قائمة المنتجات",
  "data": [
    {
      "id": 1,
      "name": "Laptop",
      "price": 1200,
      "quantity": 10
    }
  ]
}
```

---

## 5️⃣ جلب منتج واحد

```
GET
http://localhost/api_mvc/api/products/1
```

---

## 6️⃣ إضافة منتج

### 📌 Request

```
POST
http://localhost/api_mvc/api/products
```

### 📌 Headers

```
Content-Type: application/json
Authorization: Bearer {{token}}
```

### 📌 Body

```json
{
  "name": "Mouse",
  "price": 25,
  "quantity": 100
}
```

---

## 7️⃣ تحديث منتج

```
PUT
http://localhost/api_mvc/api/products/1
```

```json
{
  "price": 30,
  "quantity": 80
}
```

---

## 8️⃣ حذف منتج

```
DELETE
http://localhost/api_mvc/api/products/1
```

---

## 9️⃣ تسجيل الخروج (Stateless)

```
POST
http://localhost/api_mvc/api/logout
```

📌 **ملاحظة مهمة**

> logout لا يبطل الـ token
> فقط للـ Frontend
> JWT يبقى صالحًا حتى `exp`

---

## 🔴 أخطاء شائعة ومهمة

### ❌ Unauthorized

**الأسباب:**

* لم ترسل Authorization
* Token منتهي
* Secret مختلف

---

### ❌ Invalid token format

**السبب:**

```
Authorization: TOKEN
```

✔️ الصحيح:

```
Authorization: Bearer TOKEN
```

---

### ❌ Token expired

✔️ أعد login

---

## 🧠 ربط الكود بالشرح (للتأكد)

| الكود                  | Postman              |
| ---------------------- | -------------------- |
| `requireAuth()`        | Authorization Header |
| `createJWT()`          | token                |
| `verifyJWT()`          | تحقق تلقائي          |
| `ApiResponse::error()` | JSON Error           |

---

## ✅ الخلاصة النهائية

* API نظيف ✔️
* JSON only ✔️
* JWT صحيح ✔️
* Postman مضبوط ✔️
* Controller احترافي ✔️

---

