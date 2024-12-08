# Pelusa Trader Project Overview

## 1. General Overview
- **Project Name: Pelusa Trader**
- **General Description:**
A comprehensive automated trading system managing multiple components, from receiving alarms to advanced strategies.
Includes a frontend (React) and multiple backends (FastAPI).
Focused on automation, modularity, security, and maintainability.

## 2. Related Repositories
- **Frontend:** strateger-react
Built with React, Redux, Tailwind CSS, Headless UI, and Lightweight Charts.
Manages alarms, strategies, backtesting, and more.

- **Backends:**
    - backend-alarmhugger: Manages the reception and storage of alarms from TradingView.
    - backend-strateger: Provides CRUD endpoints for databases hosted on Siteground.
    - backend-siteground: Integrates directly with the database hosted on Siteground.

- **Extras:**
    - algorithmic-trading-pinescript: Contains prebuilt strategies and PineScript scripts for TradingView.

## 3. Key Project Components
### **Frontend (strateger-react):**
- Main Components:
    - Strategy, Alarms, Orders, Account, NavBar, Positions, Charts, Backtesting, Diary, ToolBar, etc.
- Modular Structure:
    - Clear separation of logic, hooks, and containers.
    - Each component follows a detailed development cycle (see below).

###  **Backends (General):**
- AlarmHugger:
    - Receives alarms from TradingView and stores them in databases.
    - Designed to operate securely and modularly.
- Strateger API:
    - Manages CRUD operations for multiple databases (Accounts, Orders, Positions, Strategies, Diary, Backtesting).
### **Extras (Pinescript):**
- PineScript:
    - Strategies include candlestick pattern detection and indicator analysis (RSI, Stochastic, moving averages).


## 4. Technologies Used
### **Frontend:**
- Framework: React
- State Management: Redux Toolkit
- UI Design: Tailwind CSS, Headless UI
- Data Visualization: Lightweight Charts, Chart.js
- HTTP Requests: Axios
- Testing: Jest, React Testing Library

### **Backend:**
- Framework: FastAPI
- Database: MySQL (Hosted on Siteground)
- Deployment: Uvicorn, Gunicorn
- Strategies: PineScript v5 (TradingView)
- Other Tools: SQLAlchemy, Loguru, aiomysql

### **Extras:**
- Pinescript: Lenguage to create scripts in tradingview

## 5. Organization and Methodology
### GitHub Workflow:
- Uses only two main branches: main and develop.
- Commits: Follows the Conventional Commits standard.

### Documentation:
- Written in Markdown, separated by component.
- Templates defined for frontend and backend include:
    - Requirements specification, UI/UX design, logic design, data design, implementation, testing, documentation, review, and deployment.

### GitHub Projects:
- Organized in a Kanban board with columns such as:
    - No Status, Ready for Development, In Progress, Review, Done, Testing, Future Ideas.
    - Uses Date Fields (Start Date, End Date) and Iteration Fields (Sprints).



## 6. Development Cycle
### Frontend: Components
Each component follows two clear cycles: Building Cycle and Consolidate Cycle.

### Building Cycle:
1. **Requirements Specification:**
- Define what the component does and why it is necessary.
- Example: The Strategy component should allow users to create, edit, and execute trading strategies.

2. **UI/UX Design:**
- Create wireframes or mockups for the design.
- Define how users interact with the component.
- Example: Design the visual interface for the Strategy component.

3. **Logic Design:**
- Detail the internal responsibilities of the component.
- Define events and handlers.
- Example: The Strategy component should handle input data like strategy parameters and execute simulations.

4. **Data Design:**
- Define the data the component will receive and emit.
- Integrate with APIs and manage response formats.
- Example: The Strategy component should fetch and send strategy data through an endpoint like /strategies.

5. **Implementation:**
- Build the component following the specifications.
- Use relevant dependencies (Redux, Tailwind, Axios).
- Example: Create Strategy.js with logic connected to Redux and styled with Tailwind.

6. **Testing:**
- Write unit and integration tests to validate functionality.
- Tools: Jest, React Testing Library.
- Example: Verify that the Strategy component renders the available strategies correctly.

### Consolidate Cycle:
1. Usage Documentation:
- Create detailed guides on how to use the component.
- Include code examples.
- Example: Document how to integrate the Strategy component into a main page.

2. Review and Refactoring:
- Review the code, improve quality, and remove redundancies.
- Identify possible future optimizations.
- Example: Refactor Strategy logic to improve performance.

3. Integration and Deployment:
- Ensure the component works in the final environment.
- Integrate with other components.
- Example: Add Strategy to the main navigation and verify it works in production.

## Backend: Endpoints
The endpoints follow a development cycle tailored for APIs.

### Building Cycle:
**1. Requirements Specification:**
- Detail the purpose of the endpoint and its operations.
- Example: The /strategies endpoint should handle CRUD operations for strategies.

**2. Logic Design:**
- Define the responsibilities of the endpoint.
- Error handling, data validation, security.
- Example: Validate that the submitted strategy data follows predefined rules.

**3. Data Design:**
- Specify input and output data.
- Example:

    **Input (POST /strategies):**
    ```
        { "name": "Strategy 1", "rules": [...] }
    ```
    **Output:**
    ```
        { "id": 1, "name": "Strategy 1", "created_at": "2024-11-28T12:00:00Z" }
    ```

**4. Implementation:**
- Build the endpoint in FastAPI.
- Example: Implement @app.post("/strategies") with validation and database storage.

**5. Testing:**
- Validate endpoint responses with unit and integration tests.
- Tools: Pytest.
- Example: Test that the /strategies endpoint returns a 400 error for incomplete data.

### Consolidate Cycle:
**1. Documentation:**
- Create usage documentation for the endpoint.
- Example: Describe how to interact with /strategies using cURL or Postman.

**2. Review and Refactoring:**
- Optimize the endpoint's logic.
- Example: Improve SQL queries to reduce response times.

**3. Integration and Deployment:**
- Integrate the endpoint with dependent frontends or services.
- Example: Ensure the Strategy component can consume the /strategies endpoint.




