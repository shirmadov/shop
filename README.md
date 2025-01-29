




## Shop request body

### /api/catalog-order 

    {
    "user_id": 1,
    "products": [
        {
            "id": 10,
            "quantity": 2
        },
        {
            "id": 15,
            "quantity": 1
        }
    ]
    }

### /api/approve-order
    
    {
        "order_id":9
    }

## Еще что можно сделать

    1. Можно было использовать Laravel Spatie Data. 
    2. Redis для cache
