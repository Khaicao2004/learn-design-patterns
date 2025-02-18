import React from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter, Route, Routes, NavLink } from "react-router-dom";
import Home from "../Page/Home";
import About from "../Page/About";
function App(){
    return (
        <BrowserRouter>
            <h4>Navbar</h4>
            <div>
                <NavLink to="/">Home</NavLink> |
                <NavLink to="/about">About</NavLink>
            </div>
            <Routes>
                <Route path="/" element={<Home/>} />
                <Route path="/about" element={<About/>} />
            </Routes>
        </BrowserRouter>
    );
}

if(document.getElementById('app')){
    createRoot(document.getElementById('app')).render(<App/>);
}