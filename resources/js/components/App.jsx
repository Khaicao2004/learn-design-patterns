import React from 'react'
import Router from '../router/Index'
import { NavLink } from 'react-router-dom'
const App = () => {
  return (
    <div>
        <h1>Hello app</h1>
        <nav>
            <NavLink to="/">
                Go to Home
            </NavLink>
            <NavLink to="/about">
                Go to Home
            </NavLink>
            <NavLink to="/*">
                Go to Home
            </NavLink>
        </nav>
    </div>
  )
}

export default App