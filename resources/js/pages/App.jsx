import React from 'react'
import Router from '../router/Index'
import { NavLink } from 'react-router-dom'
const App = () => {
  return (
    <div>
        <h1>Hello app</h1>
        <nav>
            <NavLink to="/" className={( { isActive } ) => (isActive ? 'active' : "")}>
                Go to Home
            </NavLink>
            <NavLink to="/about" className={( { isActive } ) => (isActive ? 'active' : "")}>
                Go to About
            </NavLink>
            <NavLink to="/list" className={( { isActive } ) => (isActive ? 'active' : "")}>
                Go to list
            </NavLink>
        </nav>
        <Router/>
    </div>
  )
}

export default App