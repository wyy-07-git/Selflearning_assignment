import { NextResponse } from 'next/server'

export function middleware(request) {
    console.log('Middleware is running')
    if (req.nextUrl.pathname == '/api/hello'){
        console.log('Hello API is being called')
    }
    return NextResponse.next()

}
