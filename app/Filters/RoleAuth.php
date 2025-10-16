<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * RoleAuth Filter
 * 
 * This filter provides role-based authorization for the application.
 * It checks if users have the appropriate role to access specific routes.
 * 
 * Access Rules:
 * - Admins can access any route starting with /admin
 * - Teachers can only access routes starting with /teacher
 * - Students can only access routes starting with /student and /announcements
 * - Unauthorized access attempts redirect to /announcements with an error message
 */
class RoleAuth implements FilterInterface
{
    /**
     * Check user authorization before allowing access to protected routes
     * 
     * This method runs before the controller is executed. It verifies that:
     * 1. The user is logged in
     * 2. The user has the appropriate role for the requested route
     * 
     * @param RequestInterface $request The current request object
     * @param array|null       $arguments Optional arguments passed to the filter
     * 
     * @return RequestInterface|ResponseInterface|string|void Returns redirect if unauthorized, null if authorized
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the session service to access user data
        $session = \Config\Services::session();
        
        // First, check if the user is logged in
        // If not logged in, redirect to login page
        if (!$session->get('isLoggedIn')) {
            $session->setFlashdata('error', 'Please login to access this page.');
            return redirect()->to(base_url('login'));
        }
        
        // Get the user's role from session
        $userRole = $session->get('role');
        
        // Get the current URI path (e.g., "admin/dashboard" or "teacher/courses")
        $uri = $request->getUri()->getPath();
        
        // Remove base path if it exists (for subfolder installations)
        // This ensures we're checking the actual route, not the full URL path
        $uri = str_replace('/EXAMINATION-MIDTERM-FUNDAR', '', $uri);
        $uri = ltrim($uri, '/'); // Remove leading slash
        
        // Role-Based Access Control Logic
        
        // Admin Access Control
        // Only users with 'admin' role can access /admin/* routes
        if (strpos($uri, 'admin') === 0 && $userRole !== 'admin') {
            $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to(base_url('announcements'));
        }
        
        // Teacher Access Control
        // Only users with 'teacher' role can access /teacher/* routes
        if (strpos($uri, 'teacher') === 0 && $userRole !== 'teacher') {
            $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to(base_url('announcements'));
        }
        
        // Student Access Control
        // Students can access /student/* routes and /announcements
        // Check if trying to access student routes without student role
        if (strpos($uri, 'student') === 0 && $userRole !== 'student') {
            $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to(base_url('announcements'));
        }
        
        // If all checks pass, allow access to the requested route
        return null;
    }

    /**
     * Process after the controller execution
     * 
     * This method runs after the controller has executed but before the response
     * is sent to the client. Currently, no post-processing is needed.
     * 
     * @param RequestInterface  $request The current request object
     * @param ResponseInterface $response The response object
     * @param array|null        $arguments Optional arguments passed to the filter
     * 
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing needed for authorization
        // This method is here for completeness and future extensibility
    }
}
