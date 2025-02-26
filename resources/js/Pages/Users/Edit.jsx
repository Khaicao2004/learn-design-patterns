import React, { useState } from 'react'

const Edit = ({user}) => {
    const [name, setName] = useState(user.name);
    const [email, setEmail] = useState(user.email);
    
  return (
    <div>
        <h1 style={{ textAlign: 'center' }}>Edit</h1>
        <form>
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