import React, { useState } from 'react'
import { Link, usePage } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';
import { route } from 'ziggy-js';
import '@css/Users/Create.css';

const Create = () => {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [avatar, setAvatar] = useState(null);
    const {errors} = usePage().props;
    console.log(avatar);
    
    const submitForm = (e) => {
      e.preventDefault();
      const formData = {name, email, password};
      Inertia.post(route('users.index'), formData)
    }
  return (
    <div>
        <h1 style={{ textAlign: 'center'}}>Create</h1>
        <Link as='button' type='button' href={route('users.index')} style={{ marginBottom: 10 }}>Back to list</Link>
        <form onSubmit={submitForm}>
          <div className="mb-3">
            <label>Name:</label>
            <input type="text" name='name' value={name} onChange={(e) => setName(e.target.value)} placeholder='Nhap name'/>
            <p style={{ color: "red" }}>{errors.name}</p>
          </div>
            <label>Email:</label>
            <input type="text" name='email' value={email} onChange={(e) => setEmail(e.target.value)} placeholder='Nhap email'/>
            <p style={{ color: "red" }}>{errors.email}</p>
            <label>Password:</label>
            <input type="text" name='password' value={password} onChange={(e) => setPassword(e.target.value)} placeholder='Nhap password'/>
            <p style={{ color: "red" }}>{errors.password}</p>
            <input type="file" name='avatar' value={avatar} onChange={(e) => setAvatar(e.target.value)} />
           <div className='mt-3'>
              <button type="submit">Submit</button>
           </div>
        </form>
    </div>
    
  )
}

export default Create