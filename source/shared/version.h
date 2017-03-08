#ifndef VERSION_H
#define VERSION_H
//---------------------------------------------------------------------------------------------------------------------------------
// File: version.h
// Contents: Version number constants
//
// Microsoft Drivers 4.1 for PHP for SQL Server
// Copyright(c) Microsoft Corporation
// All rights reserved.
// MIT License
// Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files(the ""Software""), 
//  to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
//  and / or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions :
// The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
// THE SOFTWARE IS PROVIDED *AS IS*, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
//  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
//  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS 
//  IN THE SOFTWARE.
//---------------------------------------------------------------------------------------------------------------------------------

// helper macros to stringify the a macro value
#define STRINGIFY(a) TOSTRING(a)
#define TOSTRING(a) #a

#define SQLVERSION_MAJOR 4
#define SQLVERSION_MINOR 1
#define SQLVERSION_PATCH 7
#define SQLVERSION_BUILD 0

// Semantic versioning pre-release and buil metadata
#define SEMVER_PRERELEASE "-preview"
#define SEMVER_BUILDMETA

#if SQLVERSION_BUILD > 0
#undef SEMVER_BUILDMETA
#define SEMVER_BUILDMETA "+" STRINGIFY( SQLVERSION_BUILD )
#endif

#define VER_FILEVERSION_STR     STRINGIFY( SQLVERSION_MAJOR ) "." STRINGIFY( SQLVERSION_MINOR ) "." STRINGIFY( SQLVERSION_PATCH ) SEMVER_PRERELEASE SEMVER_BUILDMETA
#define _FILEVERSION            SQLVERSION_MAJOR,SQLVERSION_MINOR,SQLVERSION_PATCH,SQLVERSION_BUILD

//PECL extension verison macros
#define PHP_SQLSRV_VERSION      VER_FILEVERSION_STR
#define PHP_PDO_SQLSRV_VERSION  VER_FILEVERSION_STR

#endif // VERSION_H


