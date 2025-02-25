import React from 'react'
import { Routes, Route } from 'react-router-dom'
import Home from '../pages/HomePage';
import About from '../pages/AboutPage';;
import NotFound from '../pages/NotFoundPage';
import List from '../pages/List';
const Index = () => {
  return (
    <div>
        <Routes>
            <Route path="/" element={<Home/>}/>
            <Route path="/about" element={<About/>}/>
            <Route path="/*" element={<NotFound/>}/>
            <Route path="/list" element={<List/>}/>
        </Routes>
    </div>
  )
}

export default Index