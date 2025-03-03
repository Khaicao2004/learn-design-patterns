import React from 'react'
import { Link } from '@inertiajs/inertia-react';
import { route } from 'ziggy-js';

const Index = ({ users }) => {
    return (
        <div>
            <h1 style={{ textAlign: 'center' }}>List users</h1>
            <Link as='button' type='button' href={route('users.create')} style={{ marginBottom: 10, textAlign: 'center' }}>
                Create
            </Link>
            <table cellPadding={5} border={1} style={{
                borderCollapse: 'collapse',
                width: '100%',
                textAlign: 'center'
            }}>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th colSpan={2}>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        users.length === 0 ? (
                            <tr>
                                <th colSpan={3}>Data</th>
                            </tr>
                        ) : (users.map((user, index) => (
                            <tr key={index}>
                                <td>{index + 1}</td>
                                <td>{user.name}</td>
                                <td>{user.email}</td>
                                <td>
                                    <Link as='button' type='button' href={route('users.edit', user.id)}>Edit</Link>
                                </td>
                                <td>
                                    <Link as='button' type='button' method='delete' href={route('users.destroy', user.id)}>Delete</Link>
                                </td>
                            </tr>
                        ))
                        )
                    }
                </tbody>
            </table>
        </div>

    )
}

export default Index