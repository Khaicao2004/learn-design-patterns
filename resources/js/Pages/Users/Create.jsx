import React, { useState } from 'react'
import { Link, usePage } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';
import { route } from 'ziggy-js';


const Create = () => {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const {errors} = usePage().props;
    
    const submitForm = (e) => {
      e.preventDefault();
      const formData = {name, email, password};
      Inertia.post('/users', formData)
    }
  return (
    <div>
        <h1 style={{ textAlign: 'center'}}>Create</h1>
        <Link as='button' type='button' href={route('users.index')} style={{ marginBottom: 10 }}>Back to list</Link>
        <form onSubmit={submitForm}>
            <label>Name:</label>
            <input type="text" name='name' value={name} onChange={(e) => setName(e.target.value)} placeholder='Nhap name'/>
            <p style={{ color: "red" }}>{errors.name}</p>
            <label>Email:</label>
            <input type="text" name='email' value={email} onChange={(e) => setEmail(e.target.value)} placeholder='Nhap email'/>
            <p style={{ color: "red" }}>{errors.email}</p>
            <label>Password:</label>
            <input type="text" name='password' value={password} onChange={(e) => setPassword(e.target.value)} placeholder='Nhap password'/>
            <p style={{ color: "red" }}>{errors.password}</p>
            <button type="submit">Submit</button>
        </form>
    </div>
    
  )
}

export default Create