import React from 'react'
import { Link } from '@inertiajs/inertia-react';

const Index = ({ users }) => {
    return (
        <div>
            <h1>List users</h1>
            <Link as='button' type='button' href='/users/create' style={{ marginBottom: 10 }}>
                Create
            </Link>
            <table cellPadding={5} border={1} style={{
                borderCollapse: 'collapse'
            }}>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
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
                                    <Link as='button' type='button' href={`/users/${user.id}/edit`}>Edit</Link>
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