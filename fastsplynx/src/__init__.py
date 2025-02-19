from fastapi import FastAPI
from src.customers.routes import customer_router

version = "v1"
version_prefix = f"/api/{version}"

description = """
A REST API for a book review web service.

This REST API is able to;
- Create Read Update And delete books
- Add reviews to books
- Add tags to Books e.t.c.
    """

app = FastAPI(
    title="PluxNet & Splynx Integration API",
    description=description,
    version=version_prefix,
    # license_info={"name": "MIT License", "url": "https://opensource.org/license/mit"},
    contact={
        "name": "Charles Rossouw",
        "url": "https://github.com/meatboyed",
        "email": "charles@mbvit.co.za",
    },
    openapi_url=f"{version_prefix}/openapi.json",
    docs_url=f"{version_prefix}/docs",
    redoc_url=f"{version_prefix}/redoc"
)

app.include_router(customer_router, prefix=f"/api/{version_prefix}/customer", tags=['customer'])