export const config = {
    runtime: 'edge' 
  };
  
  export  async function POST(request) {
    try {
      const formData = await request.formData();
      const name = formData.get('name');
      const email = formData.get('email');
      const committee = formData.get('committee');
  
      
      if (!name || !email || !committee) {
        return new Response(JSON.stringify({ error: 'Missing required fields' }), {
          status: 400,
          headers: { 'Content-Type': 'application/json' }
        });
      }
      
      console.log('Received application:', { name, email, committee });
  
      return new Response(JSON.stringify({ 
        success: true,
        message: 'Application received' 
      }), {
        status: 200,
        headers: { 'Content-Type': 'application/json' }
      });
  
    } catch (error) {
      return new Response(JSON.stringify({ 
        error: 'Internal server error' 
      }), {
        status: 500,
        headers: { 'Content-Type': 'application/json' }
      });
    }
  }
  export function GET() {
    return new Response(JSON.stringify({ error: 'Method not allowed' }), {
      status: 405
    });
  }