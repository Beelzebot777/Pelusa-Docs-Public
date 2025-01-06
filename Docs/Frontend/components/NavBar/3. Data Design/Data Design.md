# Data Design

## **Input Data**

- **Data Received**:
  - `navigationItems`: Array of objects representing the navigation components.
    ```typescript
    type NavigationItem = {
      id: string;
      name: string;
      icon: string; // Path to the icon or a reference to the icon component
      route: string; // Route associated with the navigation item
      disabled: boolean; // Indicates whether the item is clickable
    };
    navigationItems: Array<NavigationItem>
    ```
  - Example:
    ```json
    [
      { "id": "alarms", "name": "Alarmas", "icon": "AlarmsIcon", "route": "/alarms", "disabled": false },
      { "id": "battlefield", "name": "Battle Field", "icon": "battleFieldIcon", "route": "/battlefield", "disabled": true },
      { "id": "orders", "name": "Órdenes", "icon": "OrdersIcon", "route": "/orders", "disabled": true },
      { "id": "strategies", "name": "Estrategias", "icon": "StrategyIcon", "route": "/strategies", "disabled": true },
      { "id": "diary", "name": "Diario", "icon": "DiaryIcon", "route": "/diary", "disabled": true },
      { "id": "account", "name": "Account", "icon": "AccountIcon", "route": "/account", "disabled": true },
      { "id": "positions", "name": "Positions", "icon": "PositionIcon", "route": "/positions", "disabled": true },
      { "id": "backtesting", "name": "Backtesting", "icon": "BacktestingIcon", "route": "/backtesting", "disabled": true },
      { "id": "earnings", "name": "Earnings", "icon": "EarningsIcon", "route": "/earnings", "disabled": true },
      { "id": "news", "name": "News", "icon": "NewsIcon", "route": "/news", "disabled": true },
      { "id": "divisas", "name": "Divisas", "icon": "DivisasIcon", "route": "/divisas", "disabled": true },
      { "id": "reina", "name": "Reina", "icon": "ReinaIcon", "route": "/reina", "disabled": true },
      { "id": "laboratory", "name": "Laboratorio", "icon": "LaboratoryIcon", "route": "/laboratory", "disabled": true },
      { "id": "configuration", "name": "Configuración", "icon": "ConfigIcon", "route": "/configuration", "disabled": true }
    ]
    ```

## **Output Data**

- **Events Emitted**:
  - `onNavigate`: Triggered when the user clicks on a navigation item.
    ```typescript
    type NavigationEvent = {
      id: string; // ID of the clicked item
      route: string; // Associated route of the clicked item
    };
    onNavigate: (event: NavigationEvent) => void;
    ```
  - Example:
    ```json
    {
      "id": "alarms",
      "route": "/alarms"
    }
    ```

- **Routing Approach**:
  - Use React Router's `BrowserRouter`, `Routes`, and `Route` to define paths for each component.
  - Example setup:
    ```tsx
    import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
    import NavBarContainer from './NavBarContainer';
    import Alarms from './Alarms';
    import Orders from './Orders';
    import StrategyCard from './Strategy';
    // Import other components

    const App = () => (
      <Router>
        <NavBarContainer />
        <Routes>
          <Route path="/alarms" element={<Alarms />} />
          <Route path="/orders" element={<Orders />} />
          <Route path="/strategies" element={<StrategyCard />} />
          {/* Define other routes */}
        </Routes>
      </Router>
    );

    export default App;
    ```

