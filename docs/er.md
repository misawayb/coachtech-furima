```mermaid

erDiagram
    users {
        bigint id PK
        varchar name
        varchar email
        varchar password
        varchar profile_image
        varchar zip_code
        varchar address
        varchar building
        timestamp email_verified_at
        varchar remember_token
        timestamp created_at
        timestamp updated_at
    }

    items {
        bigint id PK
        bigint user_id FK
        varchar name
        int price
        varchar brand
        varchar description
        varchar image
        varchar condition
        timestamp created_at
        timestamp updated_at
    }

    categories {
        bigint id PK
        varchar name
        timestamp created_at
        timestamp updated_at
    }

    item_category {
        bigint id PK
        bigint item_id FK
        bigint category_id FK
        timestamp created_at
        timestamp updated_at
    }

    likes {
        bigint id PK
        bigint user_id FK
        bigint item_id FK
        timestamp created_at
        timestamp updated_at
    }

    comments {
        bigint id PK
        bigint user_id FK
        bigint item_id FK
        varchar comment
        timestamp created_at
        timestamp updated_at
    }

    purchases {
        bigint id PK
        bigint user_id FK
        bigint item_id FK
        varchar zip_code
        varchar address
        varchar building
        varchar payment_method
        timestamp created_at
        timestamp updated_at
    }

users ||--o{ items : "hasMany/belongsTo"
users ||--o{ comments : "hasMany/belongsTo"
users ||--o{ likes : "hasMany/belongsTo"
users ||--o{ purchases : "hasMany/belongsTo"
items }o--o{ categories : "belongsToMany"
items ||--o{ item_category : "hasMany"
categories ||--o{ item_category : "hasMany"
items ||--o{ likes : "hasMany/belongsTo"
items ||--o{ comments : "hasMany/belongsTo"
items ||--|| purchases : "hasOne/belongsTo"