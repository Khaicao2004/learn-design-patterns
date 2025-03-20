import React, { useState } from 'react'
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-react';
import { route } from 'ziggy-js';

const Edit = ({user}) => {
    const [name, setName] = useState(user.name);
    const [email, setEmail] = useState(user.email);
    const submitForm = (e) => {
        e.preventDefault();
        const formData = {name, email};
        Inertia.put(route('users.update', { id: user.id }), formData);
    }
  return (
    <div>
        <h1 style={{ textAlign: 'center' }}>Edit</h1>
        <Link as='button' type='button' href={route('users.index')} style={{ marginBottom: 10 }}>Back to list</Link>
        <form onSubmit={submitForm}>
            <label>Name:</label>
            <input type="text" name='name' value={name} onChange={(e) => setName(e.target.value)} placeholder='Nhap name'/>
            <label>Email:</label>
            <input type="text" name='email' value={email} onChange={(e) => setEmail(e.target.value)} placeholder='Nhap email'/>
            <button type="submit">Submit</button>
        </form>
    </div>
  )
}

export default Edit