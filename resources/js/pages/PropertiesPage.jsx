'use client';

import { Link } from '@inertiajs/react';
import axios from 'axios';
import { Loader2 } from 'lucide-react';
import { useEffect, useState } from 'react';
import { Button } from '../components/ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '../components/ui/card';

function PropertiesPage() {
    const [properties, setProperties] = useState([]);
    const [loading, setLoading] = useState(true);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);

    useEffect(() => {
        const fetchProperties = async () => {
            setLoading(true);
            try {
                var { data: axres } = await axios.get('/api/properties?page=' + currentPage);
                setProperties(axres.data);
                setTotalPages(Math.ceil(axres.total / axres.per_page));
            } catch (error) {
                console.log(error?.response?.data?.message);
            }
            setLoading(false);
        };

        fetchProperties();
    }, [currentPage]);

    const handlePageChange = (page) => {
        if (page > 0 && page <= totalPages) {
            setCurrentPage(page);
        }
    };

    if (loading && properties.length === 0) {
        return (
            <div className="container mx-auto flex min-h-[50vh] flex-col items-center justify-center px-4 py-8">
                <Loader2 className="text-primary mb-4 h-8 w-8 animate-spin" />
                <p>Loading properties...</p>
            </div>
        );
    }

    return (
        <div className="container mx-auto px-4 py-8">
            <div className="mb-8 flex items-center justify-between">
                <h1 className="text-2xl font-bold">Property Listings</h1>
                <Link href={route('properties.create')}>
                    <Button>Create New Listing</Button>
                </Link>
            </div>

            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                {properties.map((property) => (
                    <Link key={property.id} href={route('properties.show', property.id)}>
                        <Card className="transition-300 h-full transition-all duration-300 hover:bg-[rgba(38,38,38,0.3)] hover:shadow-md">
                            <CardHeader>
                                <CardTitle className="line-clamp-1">{property.title}</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="mb-2 text-2xl font-bold">${property.price.toLocaleString()}</p>
                                <p className="text-muted-foreground mb-2">{property.address}</p>
                                <p className="line-clamp-3">{property.description}</p>
                            </CardContent>
                            <CardFooter>
                                <p className="text-muted-foreground text-sm">Listed on {new Date(property.created_at).toDateString()}</p>
                            </CardFooter>
                        </Card>
                    </Link>
                ))}
            </div>

            <div className="mt-8 flex justify-center">
                <nav className="flex items-center space-x-2">
                    <Button variant="outline" onClick={() => handlePageChange(currentPage - 1)} disabled={currentPage === 1}>
                        Previous
                    </Button>

                    {Array.from({ length: totalPages }, (_, i) => i + 1).map((page) => (
                        <Button key={page} variant={currentPage === page ? 'default' : 'outline'} onClick={() => handlePageChange(page)}>
                            {page}
                        </Button>
                    ))}

                    <Button variant="outline" onClick={() => handlePageChange(currentPage + 1)} disabled={currentPage === totalPages}>
                        Next
                    </Button>
                </nav>
            </div>
        </div>
    );
}

export default PropertiesPage;
