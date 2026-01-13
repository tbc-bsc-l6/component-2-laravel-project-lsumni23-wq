# Student Performance API Documentation

This API allows external systems (mobile apps, student portals, etc.) to access the college's module data.

**Base URL:** `http://127.0.0.1:8000/api/v1`

---

## 1. List Available Modules
Retrieve a paginated list of all modules offered by the college.

**Endpoint:** `GET /modules`

**Parameters:**
| Name | Type | Description |
| :--- | :--- | :--- |
| `page` | `integer` | Page number for pagination (default: 1) |
| `search` | `string` | Optional keyword to filter modules by name |

**Example Request:**
```http
GET /api/v1/modules?search=Web
```

**Example Response (200 OK):**
```json
{
    "data": [
        {
            "id": 1,
            "title": "Web Application Technology",
            "status": "available",
            "enrollment_stats": {
                "current_students": 5,
                "capacity": 10,
                "spots_remaining": 5
            },
            "teacher_count": 1,
            "created_at": "2026-01-09T08:19:01+00:00"
        }
    ],
    "links": {
        "first": "...",
        "last": "..."
    },
    "meta": {
        "current_page": 1,
        "total": 1
    }
}
```

---

## 2. Get Module Details
Retrieve detailed information about a specific module.

**Endpoint:** `GET /modules/{id}`

**Example Request:**
```http
GET /api/v1/modules/1
```

**Example Response (200 OK):**
```json
{
    "data": {
        "id": 1,
        "title": "Web Application Technology",
        "status": "available",
        "enrollment_stats": {
            "current_students": 5,
            "capacity": 10,
            "spots_remaining": 5
        },
        "teacher_count": 1,
        "created_at": "2026-01-09T08:19:01+00:00"
    }
}
```
