from typing import List
from fastapi import APIRouter, HTTPException, status
from src.customers.schemas import customerschema, customerUpdateSchema

customer_router = APIRouter()

# @customer_router.get("/customers", response_model=List[customer])
@customer_router.get("/customers")
async def get_all_customers():
    return 


# @customer_router.post("/customers", status_code=status.HTTP_201_CREATED)
@customer_router.post("/customers")
async def create_a_customer() -> dict:
    return 


@customer_router.get("/customer/{customer_id}")
async def get_customer(customer_id: int) -> dict:
    # for customer in customers:
    #     if customer["id"] == customer_id:
    #         return customer

    raise HTTPException(status_code=status.HTTP_404_NOT_FOUND, detail="customer not found")


# @customer_router.patch("/customer/{customer_id}")
# async def update_customer(customer_id: int,customer_update_data:customerUpdateModel) -> dict:

#     for customer in customers:
#         if customer['id'] == customer_id:
#             customer['title'] = customer_update_data.title
#             customer['publisher'] = customer_update_data.publisher
#             customer['page_count'] = customer_update_data.page_count
#             customer['language'] = customer_update_data.language

#             return customer

#     raise HTTPException(status_code=status.HTTP_404_NOT_FOUND, detail="customer not found")


# @customer_router.delete("/customer/{customer_id}",status_code=status.HTTP_204_NO_CONTENT)
# async def delete_customer(customer_id: int):
#     for customer in customers:
#         if customer["id"] == customer_id:
#             customers.remove(customer)

#             return {}

#     raise HTTPException(status_code=status.HTTP_404_NOT_FOUND, detail="customer not found")